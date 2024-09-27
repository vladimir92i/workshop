import { useEffect, useState } from "react"
import Salles from "./components/pages/salles"
import Connexion from "./components/pages/connexion"

export default function App() {
    const [isConnected, setIsConnected] = useState<boolean>(false)
    const [user, setUser] = useState<string>("")
    const [password, setPassword] = useState<string>("")

    const handleUserConnexion = (user: string, password: string) => {
        setUser(user)
        setPassword(password)
    }
    useEffect(() => {
        fetch("https://127.0.0.1/api/user/connexion")
            .then((res) => res.json())
            .then((data) => console.log(data))
    })

    return (
        <>
            {isConnected ? (
                <Salles />
            ) : (
                <Connexion onUserChange={handleUserConnexion} />
            )}
        </>
    )
}
