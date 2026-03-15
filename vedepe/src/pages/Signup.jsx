import { useState } from "react";
import { Link } from "react-router-dom";
import { supabase } from "../lib/supabaseClient.js";
import useBodyClass from "../hooks/useBodyClass.js";
import "../styles/template.css";

function Signup() {
  useBodyClass("app");
  const [username, setUsername] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [status, setStatus] = useState({
    loading: false,
    error: "",
    message: "",
  });

  const handleSubmit = async (event) => {
    event.preventDefault();
    setStatus({ loading: true, error: "", message: "" });

    const { error } = await supabase.auth.signUp({
      email,
      password,
      options: {
        data: {
          username: username.trim(),
        },
      },
    });

    if (error) {
      setStatus({ loading: false, error: error.message, message: "" });
      return;
    }

    setStatus({
      loading: false,
      error: "",
      message: "Check your inbox to confirm your email, then log in.",
    });
  };

  return (
    <div className="signup-page">
      <h1>Create Account</h1>
      <div className="AddPersonForm">
        <form onSubmit={handleSubmit}>
          <label htmlFor="username" style={{ color: "white" }}>
            Username:
          </label>
          <input
            type="text"
            name="username"
            id="username"
            value={username}
            onChange={(event) => setUsername(event.target.value)}
            required
          />
          <label htmlFor="email" style={{ color: "white" }}>
            Email:
          </label>
          <input
            type="email"
            name="email"
            id="email"
            value={email}
            onChange={(event) => setEmail(event.target.value)}
            required
          />
          <label htmlFor="password" style={{ color: "white" }}>
            Password:
          </label>
          <input
            type="password"
            name="password"
            id="password"
            minLength={6}
            value={password}
            onChange={(event) => setPassword(event.target.value)}
            required
          />
          {status.error && <p className="form-error">{status.error}</p>}
          {status.message && <p className="form-message">{status.message}</p>}
          <button type="submit" disabled={status.loading}>
            {status.loading ? "Creating account..." : "Create account"}
          </button>
        </form>
        <p className="auth-footer">
          Already registered? <Link to="/">Login</Link>
        </p>
      </div>
    </div>
  );
}

export default Signup;
