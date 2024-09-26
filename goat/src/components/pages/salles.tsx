import { Checkbox } from "@/components/ui/checkbox"
import { Button } from "@/components/ui/button"
import { Calendar } from "@/components/ui/calendar"  
import { useEffect, useState } from "react"

interface Salle {
    name: string;
    floor: string;
}

export default function Salles() {
    const Etages = ["RDC", "1", "2"]
    const [etagesSelectionne, setEtagesSelectionne] = useState<string[]>(Etages) 
    const [salles, setSalles] = useState<Salle[]>([])
    const [sallesSelectionne, setSallesSelectionne] = useState<Salle[]>([])
    const [date, setDate] = useState<Date | undefined>(new Date())
    const [eventRoomId, setEventRoomId] = useState<integer>()
    const [isVisible, setIsVisible] = useState<boolean>(false)
    const [sendData,setSendData] = useState<boolean>(false)

    //fetch useEffect
    useEffect(() => {
        fetch("https://127.0.0.1:8000/api/room/index")
            .then(response => response.json())
            .then(data => setSalles(data))
            .catch(e => console.error(e))
    }, [])
    // check salle for the checkbox
    useEffect(() => {
        const selectedSalles = salles.filter((salle)=> etagesSelectionne.includes(salle.floor) );
        setSallesSelectionne(selectedSalles);
        console.log(selectedSalles)
    }, [etagesSelectionne, salles]);

    function clickCheckBox(data: string) {
        setEtagesSelectionne((prev) => {
          if (prev.includes(data)) {
            return prev.filter((etage) => etage !== data);
          } else {
            return [...prev, data];
          }
        });
      }


    return (
        <section>
            <div className="flex items-center space-x-2 justify-center pt-12">
                {Etages.map((etage,index) => (
                    <div key={index} className="flex items-center space-x-2">
                        <Checkbox onClick={() => { clickCheckBox(etage) }} id={`salle-${etage}`} checked={etagesSelectionne.includes(etage) } />
                        <label
                            htmlFor={`salle-${etage}`}
                            className="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                        >
                            {etage}
                        </label>
                    </div>
                ))}
            </div>
            {(isVisible) &&
            <div>
            <Calendar
              id={eventRoomId}
              mode="single"
              selected={date}
              onSelect={setDate}
              className="rounded-md border"
            />
            <Button onClick={()=>setSendData(true)}/>
            </div>
             }
            <div className="flex justify-center items-center gap-5 flex-wrap pt-16">
              {sallesSelectionne.map((salle) => (
                <Button onClick={()=> setIsVisible(isVisible),setEventRoomId(salle)} key={salle} size={"lg"}>{salle ? salle.name : "pas de salle dispo"}</Button>
              ))}
            </div>
        </section>
    )
}