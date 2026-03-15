import { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { supabase } from "../lib/supabaseClient.js";
import useBodyClass from "../hooks/useBodyClass.js";
import "../styles/landing.css";

function Landing() {
  useBodyClass("landing");
  const navigate = useNavigate();
  const [showForm, setShowForm] = useState(false);
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(false);

  const handleLogin = async (event) => {
    event.preventDefault();
    setLoading(true);
    setError("");

    const { error: signInError } = await supabase.auth.signInWithPassword({
      email,
      password,
    });

    if (signInError) {
      setError(signInError.message);
      setLoading(false);
      return;
    }

    navigate("/homepage");
  };

  return (
    <div className="landing">
      <div className={`background${showForm ? " blurred" : ""}`}></div>
      <div className="content">
        <h1 className={`memeorgy-title${showForm ? " shrinked" : ""}`}>
          <span className="meme">Meme</span>
          <span className="orgy">Orgy</span>
        </h1>
        {!showForm && (
          <button className="entrar-button" onClick={() => setShowForm(true)}>
            Entrar <i className="fas fa-arrow-right"></i>
          </button>
        )}

        {showForm && (
          <div className="rectangle">
            <div className="question-wrapper">
              <div className="question-container">
                <p>Qual e a passe chavalo?</p>
              </div>
            </div>
            <form onSubmit={handleLogin}>
              <input
                type="email"
                className="userinput"
                name="email"
                placeholder="Email"
                autoComplete="email"
                value={email}
                onChange={(event) => setEmail(event.target.value)}
                required
              />
              <input
                type="password"
                className="userinput"
                name="password"
                placeholder="Password"
                autoComplete="current-password"
                value={password}
                onChange={(event) => setPassword(event.target.value)}
                required
              />
              {error && <p className="form-error">{error}</p>}
              <button type="submit" disabled={loading}>
                {loading ? "Entrando..." : "Login"}
              </button>
            </form>
            <p className="landing-footer">
              No account? <Link to="/signup">Create one</Link>
            </p>
          </div>
        )}
      </div>
    </div>
  );
}

export default Landing;
