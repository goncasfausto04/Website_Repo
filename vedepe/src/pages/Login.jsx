import { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { supabase } from "../lib/supabaseClient.js";
import useBodyClass from "../hooks/useBodyClass.js";
import "../styles/template.css";

function Login() {
  useBodyClass("app");
  const navigate = useNavigate();
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [status, setStatus] = useState({
    loading: false,
    error: "",
  });

  const handleSubmit = async (event) => {
    event.preventDefault();
    setStatus({ loading: true, error: "" });

    const { error } = await supabase.auth.signInWithPassword({
      email,
      password,
    });

    if (error) {
      setStatus({ loading: false, error: error.message });
      return;
    }

    navigate("/homepage");
  };

  return (
    <div className="login-page">
      <h1>Login</h1>
      <div className="AddPersonForm">
        <form onSubmit={handleSubmit}>
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
            value={password}
            onChange={(event) => setPassword(event.target.value)}
            required
          />
          {status.error && <p className="form-error">{status.error}</p>}
          <button type="submit" disabled={status.loading}>
            {status.loading ? "Signing in..." : "Login"}
          </button>
        </form>
        <p className="auth-footer">
          No account? <Link to="/signup">Create one</Link>
        </p>
      </div>
    </div>
  );
}

export default Login;
