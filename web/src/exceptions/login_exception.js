import Vue from "vue";

export const keys = [
  'user.email',
  'user.password'
];

export function login(error) {
  const objKeys = Object.keys(error);

  objKeys.forEach(e => {
    for (const key of keys) {
      if (key == e) {
        Vue.$toast.error(`${error[key].shift()}`, {
          timeout: 2000,
        });
        break;
      }
    }
  });
}

export default { login }