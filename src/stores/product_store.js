import { defineStore } from 'pinia'
import axios from 'axios'

export const useProductStore = defineStore('product', {
  state: () => ({
    groups: [],
    promotions: [],
    categories: [],
    products: [],
    APIURL: 'http://localhost:3000/api/',
  }),

  getters: {
    getCategoriesByGroup: (state) => {
      return (groupName) => state.categories.filter((category) => category.group === groupName)
    },

    getProductsByGroup: (state) => {
      return (groupName) => state.products.filter((product) => product.group === groupName)
    },

    getProductsByCategory: (state) => {
      return (categoryId) => state.products.filter((product) => product.categoryId === categoryId)
    },

    getPopularProducts: (state) => {
      return state.products.filter((product) => product.countSold > 10)
    },
  },

  actions: {
    async fetchGroups() {
      const res = await axios.get(this.APIURL + 'groups')
      this.groups = res.data
    },

    async fetchPromotions() {
      const res = await axios.get(this.APIURL + 'promotions')
      this.promotions = res.data
    },

    async fetchCategories() {
      const res = await axios.get(this.APIURL + 'categories')
      this.categories = res.data
    },

    async fetchProducts() {
      const res = await axios.get(this.APIURL + 'products')
      this.products = res.data
    },

    async initStore() {
      await Promise.all([
        this.fetchGroups(),
        this.fetchPromotions(),
        this.fetchCategories(),
        this.fetchProducts(),
      ])
    },
  },
})
