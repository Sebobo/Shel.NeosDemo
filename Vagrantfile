Vagrant.configure("2") do |config|
  config.vm.provision "shell", inline: "echo Hello"

  config.vm.define "dev" do |dev|
      dev.vm.box = 'punktde/workshop'
      dev.vm.box_url = "https://punkt.de/Download/workshop.box"
      dev.vm.synced_folder '.', '/vagrant', id: 'vagrant-root', disabled: true
      dev.vm.network 'private_network', ip: '172.17.28.137'
      dev.ssh.forward_agent = true
      dev.vm.provider 'virtualbox' do |vb|
        vb.memory = '2048'
        vb.cpus = '1'
        vb.name = 'neosdemo-dev'
      end
  end

  config.vm.define "staging" do |staging|
      staging.vm.box = 'punktde/workshop'
      staging.vm.box_url = "https://punkt.de/Download/workshop.box"
      staging.vm.synced_folder '.', '/vagrant', id: 'vagrant-root', disabled: true
      staging.vm.network 'private_network', ip: '172.17.28.138'
      staging.ssh.forward_agent = true
      staging.vm.provider 'virtualbox' do |vb|
        vb.memory = '1024'
        vb.cpus = '1'
        vb.name = 'neosdemo-staging'
      end
  end
end
