import React, { useEffect, useState } from 'react';
import './CarList.css';

function CarList() {
  const [cars, setCars] = useState([]);

  useEffect(() => {
    setCars([
      { id: 1, name: 'Raudi R1', doors: 3, engineType: 'diesel' },
      { id: 2, name: 'Raudi R2', doors: 5, engineType: 'petrol' },
      { id: 3, name: 'Raudi Famille', doors: 5, engineType: 'petrol' },
    ]);
  }, []);

  return (
    <div>
      <h1>Raudi Car Models</h1>
      {cars.map(car => (
        <div key={car.id}>
          <h2>{car.name}</h2>
          <p>{car.doors} doors, {car.engineType} engine</p>
          {/* Replace this with a link to the car detail page */}
          <button>View details</button>
        </div>
      ))}
    </div>
  );
}

export default CarList;
