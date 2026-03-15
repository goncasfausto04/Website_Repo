import { useEffect, useState } from "react";
import { supabase } from "../lib/supabaseClient.js";
import "../styles/minecraft-cords.css";

function MinecraftCords() {
  const [cords, setCords] = useState([]);
  const [form, setForm] = useState({
    estrutura: "",
    x: "",
    y: "",
    dimension: "",
  });
  const [error, setError] = useState("");

  const fetchCords = async () => {
    const { data, error: fetchError } = await supabase
      .from("minecraft_cords")
      .select("id,estrutura,x,y,dimension")
      .order("id", { ascending: true });

    if (fetchError) {
      setError(fetchError.message);
      return;
    }

    setCords(data ?? []);
    setError("");
  };

  useEffect(() => {
    fetchCords();
  }, []);

  const handleChange = (event) => {
    const { name, value } = event.target;
    setForm((prev) => ({ ...prev, [name]: value }));
  };

  const addCord = async (event) => {
    event.preventDefault();

    const { error: insertError } = await supabase
      .from("minecraft_cords")
      .insert({
        estrutura: form.estrutura,
        x: form.x,
        y: form.y,
        dimension: form.dimension,
      });

    if (insertError) {
      setError(insertError.message);
      return;
    }

    setForm({ estrutura: "", x: "", y: "", dimension: "" });
    fetchCords();
  };

  const removeCord = async (id) => {
    const shouldRemove = window.confirm(
      "Are you sure you want to remove this cord?",
    );
    if (!shouldRemove) {
      return;
    }

    const { error: deleteError } = await supabase
      .from("minecraft_cords")
      .delete()
      .eq("id", id);

    if (deleteError) {
      setError(deleteError.message);
      return;
    }

    fetchCords();
  };

  return (
    <div className="minecraft-cords">
      <h1>Minecraft Cord</h1>
      {error && <p className="form-error">{error}</p>}
      <div className="container">
        <div className="table-wrapper">
          <table>
            <thead>
              <tr>
                <th>Estrutura</th>
                <th>X</th>
                <th>Y</th>
                <th>Dimension</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              {cords.map((cord) => (
                <tr key={cord.id}>
                  <td>{cord.estrutura}</td>
                  <td>{cord.x}</td>
                  <td>{cord.y}</td>
                  <td>{cord.dimension}</td>
                  <td>
                    <button
                      type="button"
                      id="removebtn"
                      onClick={() => removeCord(cord.id)}
                    >
                      Remove
                    </button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>

        <div className="addNewStructure">
          <h2>Add a New Structure</h2>
          <form onSubmit={addCord}>
            <label htmlFor="new_estrutura">Estrutura: </label>
            <input
              type="text"
              name="estrutura"
              id="new_estrutura"
              value={form.estrutura}
              onChange={handleChange}
              required
            />
            <label htmlFor="new_x">X: </label>
            <input
              type="text"
              name="x"
              id="new_x"
              value={form.x}
              onChange={handleChange}
              required
            />
            <label htmlFor="new_y">Y: </label>
            <input
              type="text"
              name="y"
              id="new_y"
              value={form.y}
              onChange={handleChange}
              required
            />
            <label htmlFor="new_dimension">Dimension: </label>
            <input
              type="text"
              name="dimension"
              id="new_dimension"
              value={form.dimension}
              onChange={handleChange}
              required
            />
            <button type="submit">Add Structure</button>
          </form>
        </div>
      </div>
    </div>
  );
}

export default MinecraftCords;
