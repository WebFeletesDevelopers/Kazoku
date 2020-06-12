import { Judoka } from "./Judoka";
import { Request } from "../util/Request";
import { Response } from "../util/Response";
import { User } from "../user/User";

export class JudokaRequest {
    /**
     * Add a judoka to the database
     * @param judoka
     */
    public static addJudoka(judoka: Judoka): Promise<Response> {
        const data = `name=${judoka.name}&lastName1=${judoka.lastName1}&lastName2=${judoka.lastName2}&sex=${judoka.sex}&idFanjyda=${judoka.idFanjyda}&dni=${judoka.dni}&birthDate=${judoka.birthDate}&phone=${judoka.phone}&email=${judoka.email}&illness=${judoka.illness}&userId=${judoka.codUsu}&parentId=${judoka.codTutor}&addressId=${judoka.codAddress}&beltId=${judoka.codBelt}&classId=${judoka.codClass}`;
        return Request.post('/judoka/add', data);
    }

    /**
     * Modifies a judoka from database
     * @param judoka
     * @param judokaId
     */
    public static modifyJudoka(judoka: Judoka, judokaId: number): Promise<Response> {

        const data = `name=${judoka.name}&lastName1=${judoka.lastName1}&lastName2=${judoka.lastName2}&sex=${judoka.sex}&idFanjyda=${judoka.idFanjyda}&dni=${judoka.dni}&birthDate=${judoka.birthDate}&phone=${judoka.phone}&email=${judoka.email}&illness=${judoka.illness}&userId=${judoka.codUsu}&parentId=${judoka.codTutor}&addressId=${judoka.codAddress}&beltId=${judoka.codBelt}&classId=${judoka.codClass}&judokaId=${judokaId}`;
        return Request.post('/judoka/modify', data);
    }

    /**
     * Delete a judoka from the database.
     * @param judokaId
     */
    public static deleteJudoka(judokaId: number): Promise<Response>
    {
        const data = `judokaId=${judokaId}`;
        return Request.post('/judoka/delete', data);
    }

    /**
     * Creates a judoka from register form
     * @param user
     */
    public static createFromRegister(user: User, frontDni: HTMLInputElement, backDni: HTMLInputElement){
        const data: FormData = new FormData();
        data.append('name', user.name);
        data.append('lastName1', user.surname);
        data.append('lastName2', user.secondSurname);
        data.append('phone', String(user.phone));
        data.append('email', user.email);
        data.append('dni-front', frontDni.files[0]);
        data.append('dni-back', backDni.files[0]);

        return Request.postFormData('/judoka/addFromRegister', data);
    }

}
