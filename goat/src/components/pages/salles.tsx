import { Checkbox } from "@/components/ui/checkbox"
import { Button } from "@/components/ui/button"
import { useEffect, useState } from "react"


export default function Salles() {
    const Etages = ["RDC","étage 1","étage 2"]
    const [salles, setSalles] = useState(["100", "101"])
    const

    useEffect(() => {
        
    },[sallesAf])
    return (
        <section>
            <div className="flex items-center space-x-2 justify-center pt-12">
                {Etages.map((etage,index) => (
                    <div key={index} className="flex items-center space-x-2">
                        <Checkbox id={`salle-${etage}`} />
                        <label
                            htmlFor={`salle-${etage}`}
                            className="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                        >
                            {etage}
                        </label>
                    </div>
                ))}
            </div>
            <div className="flex justify-center items-center gap-5 flex-wrap pt-16">
                {salles.map((salle) => (
                    <Button>{salle}</Button>
                ))}
            </div>
        </section>
    )
}