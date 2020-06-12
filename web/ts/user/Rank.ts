export enum Rank {
    ADMIN = 0,
    TRAINER ,
    PARENT,
    PUPIL,
    NOT_REGISTERED,
    INVALID = -1
}

export const numberToRank = (input: number): Rank => {
    let rank: Rank;
    switch (input) {
        case 0:
            rank = Rank.ADMIN;
            break;
        case 1:
            rank = Rank.TRAINER;
            break;
        case 2:
            rank = Rank.PARENT;
            break;
        case 3:
            rank = Rank.PUPIL;
            break;
        case -1:
            rank = Rank.INVALID;
            break;
        default:
            rank = Rank.NOT_REGISTERED;
            break;
    }
    return rank;
}
