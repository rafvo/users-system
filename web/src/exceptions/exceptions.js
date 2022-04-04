import { login } from './login_exception'
import Vue from "vue";

export function exception(e) {
  if (e && !e.response && !e.response.data)
    Vue.$toast.error("Erro desconhecido", {
      timeout: 2000,
    });

  const data = e.response.data;
  login(data);
}

export default { exception }