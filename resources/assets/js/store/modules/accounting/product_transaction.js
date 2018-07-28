const state = {
    tPaymentDue: 0,
    tPaid: 0,
    tDiscount: 0,
    tTotal:0,
    tChartData: '',
    tTableData: '',
}

const getters = {
    getTPaymentDue(state) {
        return state.tPaymentDue;
    },

    getTPaid(state) {
        return state.tPaid;
    },

    getTDiscount(state) {
        return state.tDiscount;
    },

    getTTotal(state) {
        return state.tTotal;
    },

    getTChartData(state) {
        return state.tChartData;
    },

    getTTableData(state) {
        return state.tTableData;
    }
}

const mutations = {
    setTPaymentDue(state, value){
        state.tPaymentDue = value;
    },

    setTPaid(state, value) {
        state.tPaid = value;
    },

    setTDiscount(state, value) {
        state.tDiscount = value;
    },

    setTTotal(state, value) {
        state.tTotal = value;
    },

    setTChartData(state, value) {
        state.tChartData = value;
    },

    setTTableData(state, value) {
        state.tTableData = value;
    },

    setResetTAll(state) {
        state.tPaymentDue = '';
        state.tPaid = '';
        state.tDiscount = '';
        state.tTotal = '';
        state.chartData = ''
    }
}

const actions = {
    fetchAllTransaction({commit}, payload) {
        axios.post('/api/accounting/transaction', payload)
            .then((response) => {
                commit('setTPaymentDue', response.data.payment_due);
                commit('setTPaid',response.data.paid);
                commit('setTDiscount', response.data.discount);
                commit('setTTotal', response.data.total);
                commit('setTChartData', response.data.chart_data);
                commit('setTTableData', response.data.transactions);
            });
    }
}

export default {
    state,
    getters,
    mutations,
    actions
}
