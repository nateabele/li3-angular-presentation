# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant::Config.run do |config|

  config.vm.box = "lucid64"

  config.vm.forward_port 80, 3031
  config.vm.forward_port 22, 3022

  config.vm.provision :puppet do |puppet|
    puppet.manifests_path = "_build/manifests"
    puppet.manifest_file = "default.pp"
  end
end
