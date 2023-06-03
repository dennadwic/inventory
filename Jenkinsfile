pipeline {
  agent any
  stages {
    stage ('Deploy') {
      steps{
        sshagent(credentials : ['webserver-username']) {
            sh 'scp -r /var/lib/jenkins/workspace/website-inventory/inventory bhewe@10.10.10.11:/var/www'
        }
      }
    }
  }
}