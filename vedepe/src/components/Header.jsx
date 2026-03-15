import { NavLink } from "react-router-dom";

function Header() {
  return (
    <header>
      <nav>
        <ul className="left">
          <li>
            <NavLink to="/homepage" end>
              <i className="fas fa-home"></i>
            </NavLink>
          </li>
        </ul>
        <ul className="right">
          <li>
            <NavLink to="/fumblemeter" id="rocket-league-meter-link">
              FumbleMeter
            </NavLink>
          </li>
          <li>
            <NavLink to="/casino" id="casino-link">
              Casino
            </NavLink>
          </li>
          <li>
            <NavLink to="/minecraft">Minecraft</NavLink>
          </li>
          <li>
            <NavLink to="/aboutus" id="about-us-link">
              About Us
            </NavLink>
          </li>
          <li className="profile-item">
            <NavLink to="/profile" id="profile-link" className="profile-link">
              <i className="fas fa-user"></i>
            </NavLink>
          </li>
        </ul>
      </nav>
    </header>
  );
}

export default Header;
