import { Navigate } from "react-router-dom";
import { useAuth } from "../context/AuthContext.jsx";

function RequireAuth({ children }) {
  const { session, loading } = useAuth();

  if (loading) {
    return <div className="page loading">Loading...</div>;
  }

  if (!session) {
    return <Navigate to="/" replace />;
  }

  return children;
}

export default RequireAuth;
