import { Route, Routes } from "react-router-dom";
import Landing from "./pages/Landing.jsx";
import Login from "./pages/Login.jsx";
import Signup from "./pages/Signup.jsx";
import Homepage from "./pages/Homepage.jsx";
import AboutUs from "./pages/AboutUs.jsx";
import Casino from "./pages/Casino.jsx";
import Fumblemeter from "./pages/Fumblemeter.jsx";
import Minecraft from "./pages/Minecraft.jsx";
import MinecraftCords from "./pages/MinecraftCords.jsx";
import WorkInProgress from "./pages/WorkInProgress.jsx";
import Profile from "./pages/Profile.jsx";
import RequireAuth from "./components/RequireAuth.jsx";
import AppLayout from "./layouts/AppLayout.jsx";
import "./App.css";

function App() {
  return (
    <Routes>
      <Route path="/" element={<Landing />} />
      <Route path="/login" element={<Login />} />
      <Route path="/signup" element={<Signup />} />
      <Route
        element={
          <RequireAuth>
            <AppLayout />
          </RequireAuth>
        }
      >
        <Route path="/homepage" element={<Homepage />} />
        <Route path="/aboutus" element={<AboutUs />} />
        <Route path="/profile" element={<Profile />} />
        <Route path="/casino" element={<Casino />} />
        <Route path="/fumblemeter" element={<Fumblemeter />} />
        <Route path="/minecraft" element={<Minecraft />} />
        <Route path="/minecraft/cords" element={<MinecraftCords />} />
        <Route path="/workinprogress" element={<WorkInProgress />} />
      </Route>
    </Routes>
  );
}

export default App;
