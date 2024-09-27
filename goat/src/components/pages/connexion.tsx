import { useState } from "react"
import "../../css/style.css"
import image from "../../img/frontImg.jpg"

interface ConnexionProps {
    onUserChange: (user: string, password: string) => void
}

export default function Connexion({ onUserChange }: ConnexionProps) {
    const [email, setEmail] = useState("")
    const [password, setPassword] = useState("")

    const handleEmailChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setEmail(e.target.value)
    }

    const handlePasswordChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setPassword(e.target.value)
    }

    const onButtonClick = (e: React.MouseEvent<HTMLInputElement>) => {
        e.preventDefault()
        onUserChange(email, password)
    }

    return (
        <div className="container">
            <input type="checkbox" id="flip" />
            <div className="cover">
                <div className="front">
                    <img src={image} alt="" />
                    <div className="text">
                        <span className="text-1">
                            Connecter vous pour créer un évènement
                        </span>
                        <span className="text-2">Workshop Epsi</span>
                    </div>
                </div>
            </div>
            <div className="forms">
                <div className="form-content">
                    <div className="login-form">
                        <div className="title">Connexion</div>
                        <form>
                            <div className="input-boxes">
                                <div className="input-box">
                                    <input
                                        type="text"
                                        placeholder="Email"
                                        value={email}
                                        onChange={handleEmailChange}
                                    />
                                </div>
                                <div className="input-box">
                                    <input
                                        type="password"
                                        placeholder="Mot de passe"
                                        value={password}
                                        onChange={handlePasswordChange}
                                    />
                                </div>
                                <div className="button input-box">
                                    <input
                                        onClick={onButtonClick}
                                        type="submit"
                                        value="Connexion"
                                    />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    )
}
