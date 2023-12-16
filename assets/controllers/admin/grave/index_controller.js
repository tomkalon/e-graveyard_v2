import {Controller} from '@hotwired/stimulus';
import Api from "@Api";

import $ from 'jquery';
import Cookie from 'jquery.cookie';

import {Datatable} from "tw-elements";

export default class extends Controller {
    static targets = []
    static outlets = []
    static values = {}

    connect()
    {
        const columns = [
            {label: 'ui.admin.grave.graveyard', field: 'address'},
            {label: 'ui.admin.grave.sector', field: 'company'},
            {label: 'ui.admin.grave.row', field: 'email'},
            {label: 'ui.admin.grave.number', field: 'name'},
        ];

        const asyncTable = new Datatable(
            document.querySelector('#datatable'),
            {columns,},
            {loading: true}
        );

        fetch('https://jsonplaceholder.typicode.com/users')
            .then((response) => response.json())
            .then((data) => {
                asyncTable.update(
                    {
                        rows: data.map((user) => ({
                            ...user,
                            address: `${user.address.city}, ${user.address.street}`,
                            company: user.company.name,
                            email: user.email,
                            name: user.name,
                        })),
                    },
                    {loading: false}
                );
            });
    }
}
