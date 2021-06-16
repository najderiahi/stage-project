import Example from "./Example";
import Facturation from "./Facturation";
import ReactDOM from 'react-dom';
import { useState } from 'react';

export default function FacturationManagement(props) {
    const [facturations, setFacturations] = useState(
        JSON.parse(props.facturations)
    );
    const [filteredFacturations, setFilteredFacturations] = useState([]);
    let onFacturationSelected = (selectedFacturation) => {
        if (selectedFacturation == null) return;
        setFilteredFacturations([...filteredFacturations, selectedFacturation]);
        setFacturations(
            facturations.filter((e) => e.ROWID != selectedFacturation.ROWID)
        );
    };
    return (
        <div className="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <Example
                facturations={facturations}
                onFacturationSelected={onFacturationSelected}
            />
            <Facturation facturations={filteredFacturations} />
        </div>
    );
}

if (document.getElementById("facturation-management")) {
    const propsContainer = document.getElementById("facturation-management");
    const props = Object.assign({}, propsContainer.dataset);
    ReactDOM.render(
        <FacturationManagement {...props} />,
        document.getElementById("facturation-management")
    );
}
