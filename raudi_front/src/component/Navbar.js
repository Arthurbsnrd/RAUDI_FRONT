import React from 'react';
import '../style/Navbar.css';
import { Link } from "react-router-dom";


const Navbar = () => {
  return (
    <nav>
      <ul>
        <Link to='/'>
          <li>Accueil</li>
        </Link>
        <Link to='/Detail'>
          <li>Detail</li>
        </Link>
      </ul>
    </nav>
  );
};

export default Navbar;
