import { useEffect, useState } from "react";
import { supabase } from "../lib/supabaseClient.js";
import { useAuth } from "../context/AuthContext.jsx";
import "../styles/template.css";
import "../styles/profile.css";

function Profile() {
  const { user } = useAuth();
  const [username, setUsername] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [status, setStatus] = useState({
    loading: false,
    error: "",
    message: "",
  });

  useEffect(() => {
    if (!user) {
      return;
    }

    const loadProfile = async () => {
      const { data } = await supabase
        .from("profiles")
        .select("username")
        .eq("id", user.id)
        .single();

      setUsername(data?.username ?? "");
      setEmail(user.email ?? "");
    };

    loadProfile();
  }, [user]);

  const handleSave = async (event) => {
    event.preventDefault();
    if (!user) {
      return;
    }

    setStatus({ loading: true, error: "", message: "" });

    const updates = {
      id: user.id,
      username: username.trim(),
    };

    const { error: profileError } = await supabase
      .from("profiles")
      .upsert(updates, { onConflict: "id" });

    if (profileError) {
      setStatus({ loading: false, error: profileError.message, message: "" });
      return;
    }

    let authError = null;

    if (email && email !== user.email) {
      const { error } = await supabase.auth.updateUser({ email });
      authError = error;
    }

    if (!authError && password) {
      const { error } = await supabase.auth.updateUser({ password });
      authError = error;
    }

    if (authError) {
      setStatus({ loading: false, error: authError.message, message: "" });
      return;
    }

    setPassword("");
    setStatus({ loading: false, error: "", message: "Profile updated." });
  };

  const handleLogout = async () => {
    const shouldLogout = window.confirm("Are you sure you want to log out?");
    if (!shouldLogout) {
      return;
    }

    await supabase.auth.signOut();
  };

  return (
    <div className="profile-page">
      <div className="profile-header">
        <div className="profile-avatar">
          {(username || email || "?")[0]?.toUpperCase()}
        </div>
        <div>
          <h1>Profile</h1>
          <p className="profile-subtitle">Update your account details.</p>
        </div>
      </div>

      <div className="profile-card">
        <form onSubmit={handleSave} className="profile-form">
          <div className="profile-section">
            <h2>Account</h2>
            <label htmlFor="username">Username</label>
            <input
              type="text"
              id="username"
              name="username"
              value={username}
              onChange={(event) => setUsername(event.target.value)}
              required
            />
            <label htmlFor="email">Email</label>
            <input
              type="email"
              id="email"
              name="email"
              value={email}
              onChange={(event) => setEmail(event.target.value)}
              required
            />
          </div>

          <div className="profile-section">
            <h2>Security</h2>
            <label htmlFor="password">New Password</label>
            <input
              type="password"
              id="password"
              name="password"
              value={password}
              onChange={(event) => setPassword(event.target.value)}
              placeholder="Leave blank to keep current"
            />
          </div>

          {status.error && <p className="form-error">{status.error}</p>}
          {status.message && <p className="form-message">{status.message}</p>}

          <div className="profile-actions">
            <button type="submit" disabled={status.loading}>
              {status.loading ? "Saving..." : "Save changes"}
            </button>
            <button
              type="button"
              className="logout-button"
              onClick={handleLogout}
            >
              Logout
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}

export default Profile;
