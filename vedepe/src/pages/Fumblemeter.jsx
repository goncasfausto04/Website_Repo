import { useEffect, useState } from "react";
import { supabase } from "../lib/supabaseClient.js";

function Fumblemeter() {
  const [rows, setRows] = useState([]);
  const [newName, setNewName] = useState("");
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");

  const fetchRows = async () => {
    setLoading(true);
    const { data, error: fetchError } = await supabase
      .from("counters")
      .select("id,name,fumbles,goals_stolen,good_plays")
      .order("name", { ascending: true });

    if (fetchError) {
      setError(fetchError.message);
    } else {
      setRows(data ?? []);
      setError("");
    }
    setLoading(false);
  };

  useEffect(() => {
    fetchRows();
  }, []);

  const incrementStat = async (id, stat) => {
    const { error: updateError } = await supabase.rpc("increment_counter", {
      row_id: id,
      stat_name: stat,
    });

    if (updateError) {
      setError(updateError.message);
      return;
    }

    fetchRows();
  };

  const addPerson = async (event) => {
    event.preventDefault();
    if (!newName.trim()) {
      return;
    }

    const { error: insertError } = await supabase.from("counters").insert({
      name: newName.trim(),
    });

    if (insertError) {
      setError(insertError.message);
      return;
    }

    setNewName("");
    fetchRows();
  };

  const removePerson = async (id) => {
    const shouldRemove = window.confirm(
      "Are you sure you want to remove this person?",
    );
    if (!shouldRemove) {
      return;
    }

    const { error: deleteError } = await supabase
      .from("counters")
      .delete()
      .eq("id", id);

    if (deleteError) {
      setError(deleteError.message);
      return;
    }

    fetchRows();
  };

  return (
    <div className="fumblemeter">
      <h1>Fumblemeter</h1>
      {error && <p className="form-error">{error}</p>}

      <div className="table-wrapper">
        {loading ? (
          <p>Loading...</p>
        ) : (
          <table>
            <thead>
              <tr>
                <th>Name</th>
                <th>Fumbles</th>
                <th>Goals Stolen</th>
                <th>Good Plays</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              {rows.map((user) => (
                <tr key={user.id}>
                  <td>{user.name}</td>
                  <td>{user.fumbles}</td>
                  <td>{user.goals_stolen}</td>
                  <td>{user.good_plays}</td>
                  <td>
                    <button
                      type="button"
                      onClick={() => incrementStat(user.id, "fumbles")}
                    >
                      Fumble
                    </button>
                    <button
                      type="button"
                      onClick={() => incrementStat(user.id, "goals_stolen")}
                    >
                      Goal Stolen
                    </button>
                    <button
                      type="button"
                      onClick={() => incrementStat(user.id, "good_plays")}
                    >
                      Good Play
                    </button>
                    <button
                      type="button"
                      id="removebtn"
                      onClick={() => removePerson(user.id)}
                    >
                      Remove
                    </button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        )}
      </div>

      <div className="AddPersonForm">
        <h2>Add a New Person</h2>
        <form onSubmit={addPerson}>
          <label htmlFor="new_person" style={{ color: "white" }}>
            Enter Name:
          </label>
          <input
            type="text"
            name="new_person"
            id="new_person"
            value={newName}
            onChange={(event) => setNewName(event.target.value)}
            required
          />
          <button type="submit">Add Person</button>
        </form>
      </div>
    </div>
  );
}

export default Fumblemeter;
