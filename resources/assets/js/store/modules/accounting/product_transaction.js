const state = {
    tPaymentDue: 0,
    tPaid: 0,
    tDiscount: 0,
    tTotal:0
}

const getters = {
    getTPaymentDue(state){
        return state.tPaymentDue;
    },

    getTPaid(state){
        return state.tPaid;
    },

    getTDiscount(state){
        return state.tDiscount;
    },

    getTTotal(state){
        return state.tTotal;
    }
}

const mutations = {
    setTPaymentDue(state, value){
        state.tPaymentDue = value;
    },

    setTPaid(state, value){
        state.tPaid = value;
    },

    setTDiscount(state, value){
        state.tDiscount = value;
    },

    setTTotal(state, value){
        state.tTotal = value;
    }
}

const actions = {
    fetchAllTransaction({commit}){
        axios.get('')
            .then((response) => {

            });
    }
}

export default {
    state,
    getters,
    mutations,
    actions
}