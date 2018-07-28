const state = {
    tPaymentDue: 0,
    tPaid: 0,
    tDiscount: 0,
    tTotal:0,
    tChartData: '',
    tTableData: '',
    chartTitle:'',
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
    },
    getChartTitle(state){
        return state.chartTitle;
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
    },

    setChartTitle(state, value){
        state.chartTitle = value;
    }
}

const actions = {
    fetchAllTransaction({commit}, payload) {
        if(payload.select.abbr === 'TDT'){
            commit('setChartTitle', 'Today')
        }

        if(payload.select.abbr === 'YDT'){
            commit('setChartTitle', 'Yesterday')
        }

        if(payload.select.abbr === 'TWT'){
            commit('setChartTitle', 'This Week')
        }

        if(payload.select.abbr === 'LWT'){
            commit('setChartTitle', 'Last Week')
        }

        if(payload.select.abbr === 'TMT'){
            commit('setChartTitle', 'This Month')
        }

        if(payload.select.abbr === 'LMT'){
            commit('setChartTitle', 'Last Month')
        }

        if(payload.select.abbr === 'TYT'){
            commit('setChartTitle', 'This Year')
        }
        if(payload.select.abbr === 'LYT'){
            commit('setChartTitle', 'Last Year')
        }

        if(payload.select.abbr === 'CRT' || payload.select.abbr === 'CDT'){
            commit('setChartTitle', 'Custom Day')
        }

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
