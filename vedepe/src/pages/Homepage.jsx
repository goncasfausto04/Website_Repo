import { useEffect, useState } from "react";
import { supabase } from "../lib/supabaseClient.js";
import { useAuth } from "../context/AuthContext.jsx";
import "../styles/homepage.css";

function Homepage() {
  const { user } = useAuth();
  const [username, setUsername] = useState("User");
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const loadProfile = async () => {
      if (!user) {
        setLoading(false);
        return;
      }

      const { data, error } = await supabase
        .from("profiles")
        .select("username")
        .eq("id", user.id)
        .single();

      if (!error && data?.username) {
        setUsername(data.username);
      } else if (user.email) {
        setUsername(user.email.split("@")[0]);
      }

      setLoading(false);
    };

    loadProfile();
  }, [user]);

  return (
    <div className="homepage">
      <main>
        <h1>
          Bem-Vindo ao <span className="rainbow-text">Meme</span>{" "}
          <span className="rainbow-text">Orgy</span>,{" "}
          {loading ? "..." : username}!
        </h1>
      </main>

      <div className="container">
        <div id="carousel">
          <figure>
            <img src="/images/faustino.jpg" alt="" />
          </figure>
          <figure>
            <img src="/images/correia.jpg" alt="" />
          </figure>
          <figure>
            <img src="/images/tomas.jpg" alt="" />
          </figure>
          <figure>
            <img src="/images/jesus.jpg" alt="" />
          </figure>
          <figure>
            <img src="/images/renato.jpg" alt="" />
          </figure>
          <figure>
            <img src="/images/david.jpg" alt="" />
          </figure>
          <figure>
            <img src="/images/silva.jpg" alt="" />
          </figure>
          <figure>
            <img src="/images/govi.jpg" alt="" />
          </figure>
          <figure>
            <img src="/images/salmoes.jpg" alt="" />
          </figure>
        </div>
      </div>
    </div>
  );
}

export default Homepage;
