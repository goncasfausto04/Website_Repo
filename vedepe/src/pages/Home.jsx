import { NavLink } from "react-router-dom";

function Home() {
  return (
    <div className="page home">
      <section className="hero">
        <div className="hero-text">
          <p className="eyebrow">Homepage</p>
          <h1>Vedepe is your next playground.</h1>
          <p className="lead">
            Spin up new worlds, score big, and keep your progress safe with
            Supabase.
          </p>
          <div className="hero-actions">
            <NavLink to="/signup" className="primary-btn">
              Create account
            </NavLink>
            <NavLink to="/login" className="ghost-btn">
              I already have one
            </NavLink>
          </div>
        </div>
        <div className="hero-card">
          <div className="card-header">
            <span>Live</span>
            <p>Session snapshot</p>
          </div>
          <div className="card-body">
            <div>
              <p className="stat-label">Active players</p>
              <p className="stat-value">2,148</p>
            </div>
            <div>
              <p className="stat-label">Top arena</p>
              <p className="stat-value">Nether Ridge</p>
            </div>
            <div>
              <p className="stat-label">Streak boost</p>
              <p className="stat-value">+18%</p>
            </div>
          </div>
        </div>
      </section>

      <section className="features">
        <article>
          <h2>Single account</h2>
          <p>Use Supabase Auth for fast login and secure sessions.</p>
        </article>
        <article>
          <h2>Progress ready</h2>
          <p>Profiles are stored in Postgres and grow with your worlds.</p>
        </article>
        <article>
          <h2>Expansion slots</h2>
          <p>Add casino or Minecraft modules whenever you want.</p>
        </article>
      </section>
    </div>
  );
}

export default Home;
