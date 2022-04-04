export default class Users {

  constructor({
    id = null,
    name = null,
    phone = null,
    photo = null,
    email = null,
    email_verified_at = null,
    last_access = null,
    password = null,
    remember_token = null
  } = {}) {
    this.id = id,
      this.name = name,
      this.phone = phone,
      this.photo = photo,
      this.email = email,
      this.email_verified_at = email_verified_at,
      this.last_access = last_access,
      this.password = password,
      this.remember_token = remember_token
  }

  create(model) {
    if(!model) model = new Users();

    Object.keys(model).forEach(key => {
      this[key] = model[key];
    });
  }
}