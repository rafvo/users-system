import { Environments } from "./environments";

export class ConfigEnvironments {
  
  static _currentEnvironments = Environments.DEV;
  static _availableEnvironments = [
    {
      'env': Environments.PRODUCTION,
      'url': '',
    },
    {
      'env': Environments.HOMOLOG,
      'url': '',
    },
    {
      'env': Environments.DEV,
      'url': 'http://localhost:7000/api',
    },
  ];

  static getCurrentEnvironment() {
    return this._availableEnvironments.find(
      (d) => d['env'] == this._currentEnvironments
    );
  }

  static getUrl() {
    const env = this.getCurrentEnvironment();
    return env.url;
  }
}