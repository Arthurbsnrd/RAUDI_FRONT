import '../style/App.css';
import Navbar from './Navbar';
import Footer from './Footer';
import Detail from './Detail';
import Accueil from './Accueil';

import { useState } from 'react';

import {
  Routes,
  Route,
} from "react-router-dom";

function App() {

  
  const [theme, setTheme] = useState('light');
  const toggleTheme = () => {
      if (theme === 'light') {
        setTheme('dark');
      } else {
        setTheme('light');
      }
    };
  return(
    
    <div className={theme}>
      <Banner mode={theme}/>
      <button class="mode" onClick={toggleTheme}>🌙</button>

      <Routes>
        <Route path="/" element={<Accueil mode={theme} />}>
        </Route>

        <Route path="/Detail" element={<Produit mode={theme}/>}>
        </Route>
        
      </Routes>
      
      <Footer mode={theme}/>
    </div>
  )

}

export default App;