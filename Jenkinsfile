pipeline {
  agent any
  stages {
    stage ('Deploy') {
      steps{
        sshagent(credentials : ['webserver-inventory']) {
            sh 'ssh -o StrictHostKeyChecking=no bhewe@10.10.10.11 uptime'
            sh 'ssh -v bhewe@10.10.10.11'
            // sh 'scp ./source/filename bhewe@10.10.10.11:/remotehost/target'
        }
      }
    }
  }
}