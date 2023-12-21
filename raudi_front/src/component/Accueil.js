import '../style/Accueil.css';
import React from 'react';


function Accueil(props){
    let theme= props.mode
    return <div className={`contenue ${theme}`}>
        
        <p><h1>Bienvenue sur le site de ReactBMW MotorSport</h1></p>        
            <p>
                <h3>Notre entreprise propose des modifications de véhicule et des prototypes 
                demander par des clients ou communautés comme des préparations de véhicule atypique.</h3>
            </p>

            <div className='services'>
                <div className='service'>
                    <h3>Customisation de véhicule</h3>
                    <img class="img-service" src={Custom} alt=""></img>
                </div>
            
                <div className='service'>
                    <h3>Vente de véhicule</h3>
                    <img class="img-service" src={Prototype} alt=""></img>
                </div>     
            </div> 
        </div>
}

export default Accueil;