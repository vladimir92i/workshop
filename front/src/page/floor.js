import { useState, useEffect } from "react"
import DropDown from "../components/dropdown"
import Room from "../components/room"

export default function Floor() {
    const [salles, setSalles] = useState([])
    const [etages, setEtages] = useState([])
    useEffect(() => {
        const fetchedSalles = ["101", "102"];
        const fetchedEtages = ["Rdc","Etage 1", "Etage 2"]
        setSalles(fetchedSalles);
        setEtages(fetchedEtages)
    }, []);
    return (
        <section className="flex flex-col items-center pt-4">
            <DropDown etages={etages} />
            <section className="flex flex-row flex-wrap pt-7 gap-5">
                    {salles.map((value, index) => (
                        <Room key={index} roomName={value} />
                    ))}
            </section>
        </section>
    )
}