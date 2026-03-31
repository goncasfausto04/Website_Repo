import { useNavigate } from "react-router-dom";
import "../styles/minecraft.css";

function Minecraft() {
  const navigate = useNavigate();

  return (
    <div className="minecraft-page">
      <main>
        <h1>Minecraft</h1>
        <div className="minecraft-actions">
          <button type="button" onClick={() => navigate("/minecraft/cords")}>
            Cords
          </button>
          <button type="button" onClick={() => navigate("/workinprogress")}>
            Tasks
          </button>
        </div>
      </main>
    </div>
  );
}

export default Minecraft;
