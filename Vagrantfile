VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  config.vm.box = "DreiWolt/devops007"
  config.vm.network :private_network, ip: "192.168.3.13"
  config.vm.hostname = "CCOne"
  config.vm.synced_folder ".", "/vagrant", type: "nfs"
  config.hostsupdater.aliases = ["dev.c-und-c.one", "pma.c-und-c.one", "readis.c-und-c.one"]

  config.vm.provision "shell", path: "env/bootstrap.sh", run: "always"

end
