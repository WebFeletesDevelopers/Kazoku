import { AddressAutocompleteData } from "./AddressAutocompleteData";
import { AddressRequest } from "./AddressRequest";
import { Address } from "./Address";

/**
 * Address scripts
 */
export class AddressMain {
    public static handle(): void {
        const isAutocompletePage: boolean = !! document.querySelector('[data-action="address-autocomplete"]');

        if (isAutocompletePage) {
            AddressMain.handleAutocomplete();
            AddressMain.handleJudokaAddressUpdate();
        }
    }

    /* Autocomplete */

    /**
     * Handle autocomplete scripts
     * @private
     */
    private static handleAutocomplete(): void {
        const formElement: HTMLFormElement = document.querySelector('[data-action="address-autocomplete"] form');
        const addressElement: HTMLInputElement = formElement.querySelector('input[name="address"]');
        const cityElement: HTMLInputElement = formElement.querySelector('input[name="city"]');
        const zipCodeElement: HTMLInputElement = formElement.querySelector('input[name="zip"]');
        const autocompleteData: AddressAutocompleteData = new AddressAutocompleteData();

        addressElement.addEventListener('keyup', e => {
            const target: HTMLInputElement = (e.target as HTMLInputElement);
            autocompleteData.address = target.value;
            AddressMain.requestAutoComplete(autocompleteData, addressElement, cityElement, zipCodeElement);
        });
    }

    /**
     * Handle the autocomplete request
     * @param autocompleteData
     * @private
     */
    private static requestAutoComplete(
        autocompleteData: AddressAutocompleteData,
        addressElement: HTMLInputElement,
        cityElement: HTMLInputElement,
        zipCodeElement: HTMLInputElement
    ): void {
        AddressRequest.getAutocomplete(autocompleteData).then(res => {
            const autocompleteDiv = document.querySelector('div.address-selector-autocomplete');
            if (! autocompleteDiv) {
                return;
            }
            const addresses: Array<Address> = [];
            res.message.forEach(element => {
                addresses.push(new Address(element['id'], element['address'], element['city'], element['zip_code']));
            })

            autocompleteDiv.querySelectorAll('.autocomplete-element').forEach(e => {
                e.remove();
            });

            addresses.forEach(address => {
                const selection: HTMLDivElement = document.createElement('div');
                selection.classList.add('autocomplete-element');
                selection.innerText = address.address;

                selection.addEventListener('click', e => {
                    autocompleteDiv.remove();
                    addressElement.dataset.id = String(address.id);
                    addressElement.value = address.address;
                    cityElement.value = address.city;
                    zipCodeElement.value = String(address.zipCode);
                    addressElement.readOnly = true;
                    cityElement.readOnly = true;
                    zipCodeElement.readOnly = true;
                });

                autocompleteDiv.appendChild(selection);
            });
        });
    }

    /* Address update */

    private static handleJudokaAddressUpdate(): void {
        const formElement: HTMLFormElement = document.querySelector('[data-action="address-autocomplete"] form');
        const addressElement: HTMLInputElement = formElement.querySelector('input[name="address"]');
        const cityElement: HTMLInputElement = formElement.querySelector('input[name="city"]');
        const zipCodeElement: HTMLInputElement = formElement.querySelector('input[name="zip"]');
        const buttonElement: HTMLButtonElement = formElement.querySelector('button#mod-address');
        const userId: number = parseInt(formElement.dataset.judokaid);

        buttonElement.addEventListener('click', e => {
            e.preventDefault();
            const address: Address = new Address(
                parseInt(addressElement.dataset.id),
                addressElement.value,
                cityElement.value,
                parseInt(zipCodeElement.value)
            );
            AddressMain.updateAddress(address, userId, buttonElement);
        });
    }

    /**
     * Sends the address created to the back-end
     * @param address
     * @param userId
     * @param submitButton
     */
    private static updateAddress(address: Address, userId: number, submitButton: HTMLButtonElement): void  {
        AddressRequest.updateAddress(address, userId).then(res => {
            document.location.reload();
        })
    }
}
