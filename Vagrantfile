VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  config.vm.box = "DreiWolt/devops007"
  config.vm.network :private_network, ip: "192.168.3.13"
  config.vm.hostname = "CCOne"
  config.hostsupdater.aliases = ["dev.c-und-c.one.de", "pma.c-und-c.one.de", "readis.c-und-c.one.de"]

  config.vm.provision "shell", path: "env/bootstrap.sh", run: "always"

end
