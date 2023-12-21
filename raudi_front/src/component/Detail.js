import '../style/Produit.css';
import React from 'react';
import { Link } from "react-router-dom";



function Produit(props) {
  let theme= props.mode
    const Detail = 
    [
        
]
return(
    <div className={`card_items  ${theme}`}>
        {Detail.map((Detail, index) => (
        <div className='item'>
            
            <div>
               <img className='img-card' src={Detail.image} alt=''/> 
            </div>

            <div className='body-card'>
                <p>{Detail.commentaire}</p>
            </div>
        </div>
        ))}
    </div>
)}

export default Produit;