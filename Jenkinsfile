pipeline {
  agent any
  stages {
    stage ('Deploy') {
      environment {
        Inventory_Token = credentials{'webserver-username'}
      }
      steps{
            sh 'sshpass -p $Inventory_Token scp -r /var/lib/jenkins/workspace/website-inventory/inventory bhewe@10.10.10.11:/var/www'
      }
    }
  }
}