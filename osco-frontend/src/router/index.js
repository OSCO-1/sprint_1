
import { createRouter, createWebHistory } from "vue-router";
import MenuPage from "@/pages/MenuPage.vue";
import MenuItemDetail from "@/components/DetailView.vue";

const routes = [
  {
    path: "/",
    name: "Menu",
    component: MenuPage
  },
  {
    path: "/menu/:id",
    name: "MenuItemDetail",
    component: () => MenuItemDetail,
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
