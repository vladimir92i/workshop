import { useState, useEffect } from "react"
import Room from "../components/room"
import {
    Accordion,
    AccordionContent,
    AccordionItem,
    AccordionTrigger,
} from "../components/accordion"
import { Button } from "../components/button"


export default function Floor() {
    const [salles, setSalles] = useState([])
    const [etages, setEtages] = useState([])
    useEffect(() => {
        const fetchedSalles = ["101", "102"];
        const fetchedEtages = ["Rdc", "Etage 1", "Etage 2"]
        setSalles(fetchedSalles);
        setEtages(fetchedEtages)
    }, []);
    return (
        // <section className="flex flex-col items-center pt-4">
        <>
            <Button variant="destructive">Salut</Button>
            <Accordion type="single" collapsible className="w-full">
      <AccordionItem value="item-1">
        <AccordionTrigger>Is it accessible?</AccordionTrigger>
        <AccordionContent>
          Yes. It adheres to the WAI-ARIA design pattern.
        </AccordionContent>
      </AccordionItem>
      <AccordionItem value="item-2">
        <AccordionTrigger>Is it styled?</AccordionTrigger>
        <AccordionContent>
          Yes. It comes with default styles that matches the other
          components&apos; aesthetic.
        </AccordionContent>
      </AccordionItem>
      <AccordionItem value="item-3">
        <AccordionTrigger>Is it animated?</AccordionTrigger>
        <AccordionContent>
          Yes. It&apos;s animated by default, but you can disable it if you
          prefer.
        </AccordionContent>
      </AccordionItem>
        </Accordion>
        </>


        //     <DropDown etages={etages} />
        //     <section className="flex flex-row flex-wrap pt-7 gap-5">
        //         {salles.map((value, index) => (
        //             <Room key={index} roomName={value} />
        //         ))}
        //     </section>
        // </section>
    )
}