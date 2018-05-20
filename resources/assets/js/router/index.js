import Vue from 'vue'
import Router from 'vue-router'
import CategoryComponent from '../components/pages/categories/CategoryIndexComponent'
import ProductComponent from '../components/pages/products/ProductsComponent'
import TransactionComponent from '../components/pages/transaction/TransactionComponent'
import CustomerComponent from '../components/pages/customer/CustomerComponent'


Vue.use(Router)

const routes = [
    {
        path: '/',
        name: 'home',
        component: CategoryComponent
    },

    {
        path: '/categories',
        name: 'categories',
        component: CategoryComponent
    },

    {
        path: '/products',
        name: 'products',
        component: ProductComponent
    },

    {
        path: '/transaction',
        name: 'transaction',
        component: TransactionComponent
    },

    {
        path: '/customers',
        name: 'customers',
        component: CustomerComponent
    },
    {
        path: '/customers/:id/transitions',
        name: 'customers_transitions',
        component: CustomerComponent
    }
]

export default new Router({
    mode: 'history',
    routes
})
