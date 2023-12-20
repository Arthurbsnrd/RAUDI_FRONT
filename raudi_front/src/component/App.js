import React from 'react';
import './App.css';

function App() {
  return (
    <div className="App">
      <header className="App-header">
        <h1>RAUDI Cars</h1>
        <p>Discover the excellence in automotive engineering.</p>
        <img
          src="https://via.placeholder.com/400x200"
          className="App-logo"
          alt="RAUDI Logo"
        />
      </header>
      <section className="CarModels">
        <h2>Featured Models</h2>
        <div className="CarList">
          {/* Ajoutez les informations sur les modèles de voitures RAUDI */}
          <div className="CarCard">
            <img src="https://via.placeholder.com/200x100" alt="Car Model" />
            <h3>RAUDI A1</h3>
            <p>Compact, stylish, and powerful.</p>
          </div>
          {/* Ajoutez d'autres modèles de voitures ici */}
        </div>
      </section>
      <footer className="App-footer">
        <p>&copy; 2023 RAUDI Cars. All rights reserved.</p>
      </footer>
    </div>
  );
}

export default App;
