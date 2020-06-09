import {Judoka} from "./Judoka";
import {Request} from "../util/Request";
import {Response} from "../util/Response";

export class JudokaRequest {
    /**
     * Add a judoka to the database
     * @param judoka
     */
    public static addNews(search: string): Promise<Response> {
        const data = `search=${search}`;
        return Request.post('/judoka/find', data);
    }

    /**
     * Modifies a judoka from database
     * @param judoka
     * @param judokaId
     */
    public static modifyJudoka(judoka: Judoka, judokaId: number): Promise<Response> {

        const data = `name=${judoka.name}
        &lastName1=${judoka.lastName1}&lastName2=${judoka.lastName2}&sex=${judoka.sex}&idFanjyda=${judoka.idFanjyda}&dni=${judoka.dni}&birthDate=${judoka.birthDate}&phone=${judoka.phone}&email=${judoka.email}&illness=${judoka.illness}&userId=${judoka.codUsu}&parentId=${judoka.codTutor}&addressId=${judoka.codAddress}&beltId=${judoka.codBelt}&classId=${judoka.codClass}&judokaId=${judokaId}`;
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
}
