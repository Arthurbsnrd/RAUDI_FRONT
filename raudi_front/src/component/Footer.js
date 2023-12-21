import '../Footer.css';
import * as React from "react";
import { Link } from "react-router-dom";

function Footer(props){
    let theme= props.mode
    const numero = "06.12.34.56.78";
    const site = "https://ecole-ipssi.com";
    return <footer>
        <div className={` siteFooter ${theme}`}>
            <h4>
                Compléments d'informations :
            </h4>
            <ul className="liste">
                <li> numéro : {numero}</li>
                <li> site officiel: <a href={site} target="blank">IPSSI</a></li>
                <Link to='/MentionsLegal'>
                    <li> all right reserved</li>
                </Link>
            </ul>
        </div>
    </footer>
}

export default Footer;