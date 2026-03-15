import { Outlet } from "react-router-dom";
import Header from "../components/Header.jsx";
import Footer from "../components/Footer.jsx";
import useBodyClass from "../hooks/useBodyClass.js";
import "../styles/template.css";

function AppLayout() {
  useBodyClass("app");

  return (
    <div className="app-shell">
      <Header />
      <main>
        <Outlet />
      </main>
      <Footer />
    </div>
  );
}

export default AppLayout;
