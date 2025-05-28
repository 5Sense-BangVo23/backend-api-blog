export default class User {
  constructor(data) {
    this.id = data.id;
    this.email = data.email;
    this.name = data.name;
  }

  isAdmin() {
    return this.email.endsWith('@admin.com');
  }
}
