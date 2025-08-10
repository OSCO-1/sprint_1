
import { createRouter, createWebHistory } from "vue-router";
import LanguageSelector from "@/pages/LanguageSelector.vue";
import LandingPage from "@/pages/LandingPage.vue";
import MenuPage from "@/pages/MenuPage.vue";
import InfoPage from "@/pages/InfoPage.vue";
import MenuItemDetail from "@/components/DetailView.vue";

const routes = [
  {
    path: "/",
    name: "LanguageSelector",
    component: LanguageSelector
  },
  {
    path: "/landing",
    name: "Landing",
    component: LandingPage
  },
  {
    path: "/menu",
    name: "Menu",
    component: MenuPage
  },
  {
    path: "/info",
    name: "Info",
    component: InfoPage
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
