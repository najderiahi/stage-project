import ReactDOM from "react-dom";
import { Fragment, useState } from "react";
import { Listbox, Transition } from "@headlessui/react";
import { CheckIcon, SelectorIcon } from "@heroicons/react/solid";

export default function Example(props) {
    const { facturations, onFacturationSelected } = props;
    const [selected, setSelected] = useState(null);
    return (
        <div className="flex mb-4 space-x-4">
            <div className="w-72">
                <Listbox value={selected} onChange={setSelected}>
                    <div className="relative mt-1">
                        <Listbox.Button className="relative w-full py-2 pl-3 pr-10 text-left bg-white rounded-lg shadow-sm border border-gray-300 cursor-default focus:outline-none focus-visible:ring-2 focus-visible:ring-opacity-75 focus-visible:ring-white focus-visible:ring-offset-orange-300 focus-visible:ring-offset-2 focus-visible:border-indigo-400 sm:text-sm">
                            <span
                                className={`block truncate ${
                                    selected ? "" : "text-gray-500"
                                }`}
                            >
                                {selected
                                    ? selected.DESCRIPT
                                    : "Pas de selection"}
                            </span>
                            <span className="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                <SelectorIcon
                                    className="w-5 h-5 text-gray-400"
                                    aria-hidden="true"
                                />
                            </span>
                        </Listbox.Button>
                        <Transition
                            as={Fragment}
                            leave="transition ease-in duration-100"
                            leaveFrom="opacity-100"
                            leaveTo="opacity-0"
                        >
                            <Listbox.Options className="absolute w-full py-1 mt-1 overflow-auto text-base bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                {facturations.map((facturation, factIdx) => (
                                    <Listbox.Option
                                        key={factIdx}
                                        value={facturation}
                                        className={({ active }) =>
                                            `${
                                                active
                                                    ? "text-blue-900 bg-blue-100"
                                                    : "text-gray-900"
                                            } cursor-default select-none relative py-2 pl-10 pr-4`
                                        }
                                    >
                                        {({ selected, active }) => (
                                            <>
                                                <span
                                                    className={`${
                                                        selected
                                                            ? "font-medium"
                                                            : "font-normal"
                                                    } block truncate`}
                                                >
                                                    {facturation.DESCRIPT}
                                                </span>
                                                {selected ? (
                                                    <span
                                                        className={`${
                                                            active
                                                                ? "text-blue-600"
                                                                : "text-blue-600"
                                                        } absolute inset-y-0 left-0 flex items-center pl-3`}
                                                    >
                                                        <CheckIcon
                                                            className="w-5 h-5"
                                                            aria-hidden="true"
                                                        />
                                                    </span>
                                                ) : null}
                                            </>
                                        )}
                                    </Listbox.Option>
                                ))}
                            </Listbox.Options>
                        </Transition>
                    </div>
                </Listbox>
            </div>
            <button
                type="button"
                onClick={() => {
                    onFacturationSelected(selected);
                    setSelected(null);
                }}
                className="py-2 bg-gray-100 text-gray-800 px-4 rounded-md text-xs truncate tracking-wide font-semibold uppercase"
            >
                Ajouter une nouvelle rubrique
            </button>
        </div>
    );
}

if (document.getElementById("example")) {
    ReactDOM.render(<Example {...props} />, document.getElementById("example"));
}
