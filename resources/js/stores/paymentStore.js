import { defineStore } from 'pinia'

export const usePaymentStore = defineStore('payment', {
    state: () => ({
        paymentData: null
    }),
    actions: {
        setPayment(data) {
            this.paymentData = data
        }
    }
})