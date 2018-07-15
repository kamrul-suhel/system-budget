import Vue from 'vue'
import Router from 'vue-router'
import CategoryComponent from '../components/pages/categories/CategoryIndexComponent'
import ProductComponent from '../components/pages/products/ProductsComponent'
import TransactionComponent from '../components/pages/transaction/TransactionComponent'
import CustomerComponent from '../components/pages/customer/CustomerComponent'
import SettingComponent from '../components/pages/setting/SettingComponent'
import CreateTransaction from '../components/pages/transaction/CreateTransactionComponent'
import TransactionPrint from '../components/pages/transaction/TransactionPrintComponent'
import EditTransactionComponent from '../components/pages/transaction/EditTransactionComponent'
import LoginComponent from '../components/pages/login/LoginComponent'
import ExpenseComponent from '../components/pages/expense/ExpenseComponent'
import ExpenseCategoryComponent from '../components/pages/expense/ExpenseCategoryComponent'


Vue.use(Router)

const routes = [
    {
        path: '/',
        name: 'login',
        component: LoginComponent
    },

    {
        path: '/home',
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
        path: '/transaction/create',
        name: 'create_transaction',
        component: CreateTransaction
    },

    {
        path: '/transaction/:id/edit',
        name: 'edit_transaction',
        component: EditTransactionComponent
    },

    {
        path: '/transaction/:id/print',
        name: 'print_transaction',
        component: TransactionPrint
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
    },

    {
        path: '/expense',
        name: 'expense',
        component: ExpenseComponent
    },

    {
        path: '/expensecategories',
        name: 'expense_categories',
        component: ExpenseCategoryComponent
    },

    {
        path: '/settings',
        name: 'settings',
        component: SettingComponent
    }
]

export default new Router({
    mode: 'history',
    routes
})
