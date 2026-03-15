import { useNavigate } from "react-router-dom";
import "../styles/minecraft.css";

function Minecraft() {
  const navigate = useNavigate();

  return (
    <div className="minecraft-page">
      <h1>Minecraft</h1>
      <div id="buttonsPlace">
        <div id="buttons">
          <button type="button" onClick={() => navigate("/minecraft/cords")}>
            Cords
          </button>
          <button
            type="button"
            onClick={() => navigate("/workinprogress")}
            style={{ marginLeft: "20px" }}
          >
            Tasks
          </button>
        </div>
      </div>
    </div>
  );
}

export default Minecraft;
