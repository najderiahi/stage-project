import ReactDOM from 'react-dom';
import React from 'react';

export default function Facturation (props) {
    const { facturations } = props;
    return (
        <div className="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table className="min-w-full divide-y divide-gray-200">
                <thead className="bg-gray-50">
                <tr>
                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                        Rubrique de facturation
                    </th>
                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                        Prix Unitaire
                    </th>
                </tr>
                </thead>
                <tbody className="bg-white divide-y divide-gray-200">
                    {
                        (facturations.map((facturation) => (
                            <tr key={facturation.ROWID}>
                                <td className="px-6 py-4 whitespace-nowrap">
                                    <div className="flex items-center">
                                        <div className="text-xs text-gray-700">
                                            {facturation.DESCRIPT}
                                        </div>
                                    </div>
                                </td>
                                <td className="px-6 py-4 whitespace-nowrap">
                                    <div className="flex items-center">
                                        <div className="text-xs text-gray-700">
                                            {facturation.SELL_PRICE}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        )))
                    }
                    <tr>
                        <td className="px-6 py-4 whitespace-nowrap border-r">
                            <div className="flex items-center">
                                <div className="text-xs text-gray-700">
                                    Prix total
                                </div>
                            </div>
                        </td>
                        <td colSpan="4" className="px-6 py-4">
                            <div>
                            {facturations.map(f => f.SELL_PRICE).reduce((item, acc) => parseFloat(item) + parseFloat(acc), 0)}</div></td>
                    </tr>
                </tbody>
            </table>
        </div>
    )
}


if(document.getElementById('facturation')) {
    const propsContainer = document.getElementById('props');
    const props = Object.assign({}, propsContainer.dataset);
    ReactDOM.render(<Facturation {...props} />, document.getElementById('facturation'))
}
