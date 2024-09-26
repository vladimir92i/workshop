import '../css/style.css'
import image from '../img/frontImg.jpg'


export default function Connexion() {
    return (
        <div class="container">
            <input type="checkbox" id="flip"/>
            <div class="cover">
                <div class="front">
                    <img src={image} alt=""/>
                        <div class="text">
                            <span class="text-1">Connecter vous pour crée un évènement</span>
                            <span class="text-2">Workshop Epsi</span>
                        </div>
                </div>
            </div>
            <div class="forms">
                <div class="form-content">
                    <div class="login-form">
                        <div class="title">Connecter-Vous</div>
                        <form action="#">
                            <div class="input-boxes">
                                <div class="input-box">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" placeholder="Entrer votre email" required/>
                                </div>
                                <div class="input-box">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" placeholder="Entrer votre mot de passe" required/>
                                </div>
                                <div class="button input-box">
                                    <input type="submit" value="Connexion"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    )
}