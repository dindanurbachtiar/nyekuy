import type React from "react"

import { useState } from "react"
import { Button } from "/components/ui/button"
import { Input } from "/components/ui/input"
import { Label } from "/components/ui/label"
import Image from "next/image"

export default function LoginPage() {
  const [username, setUsername] = useState("admin")
  const [password, setPassword] = useState("")

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault()
    // This would be your Laravel route in actual implementation
    console.log("Login attempt:", { username, password })
  }

  return (
    <div className="min-h-screen bg-gray-200 flex flex-col">
      {/* Top Dark Red Bar */}
      <div className="w-full h-8 bg-red-800"></div>
      {/* Main Content Area - Adjusted for vertical positioning */}
      <div className="flex-1 flex items-start justify-center p-4 pt-16">
        {" "}
        {/* Added pt-16 to push it down */}
        <div className="w-full max-w-6xl h-[600px] relative overflow-hidden rounded-3xl shadow-2xl">
          {/* Background Template */}
          <div className="absolute inset-0">
            <Image src="/template-bg.png" alt="Background Template" fill className="object-cover" priority />
          </div>

          {/* NYEKUY Logo - Absolutely positioned relative to the main container */}
          <div className="absolute top-1/2 -translate-y-1/2" style={{ left: "50%" }}>
            {" "}
            {/* Adjusted left position to 50% */}
            <Image src="/nyekuy-logo.png" alt="NYEKUY" width={400} height={100} className="mx-auto" priority />
          </div>

          <div className="relative z-10 flex h-full">
            {/* Left Side - Login Form */}
            <div className="flex-1 flex items-center justify-center p-8 lg:p-16">
              <div className="w-full max-w-sm space-y-6">
                <form onSubmit={handleSubmit} className="space-y-6">
                  <div className="space-y-2">
                    <Label htmlFor="username" className="text-sm font-medium text-gray-700">
                      Username
                    </Label>
                    <Input
                      id="username"
                      type="text"
                      value={username}
                      onChange={(e) => setUsername(e.target.value)}
                      className="w-full px-4 py-3 bg-gray-100 border-0 rounded-lg focus:bg-white focus:ring-2 focus:ring-red-800 transition-all text-gray-900"
                      required
                    />
                  </div>

                  <div className="space-y-2">
                    <Label htmlFor="password" className="text-sm font-medium text-gray-700">
                      Password
                    </Label>
                    <Input
                      id="password"
                      type="password"
                      value={password}
                      onChange={(e) => setPassword(e.target.value)}
                      placeholder="••••••••"
                      className="w-full px-4 py-3 bg-gray-100 border-0 rounded-lg focus:bg-white focus:ring-2 focus:ring-red-800 transition-all text-gray-900"
                      required
                    />
                  </div>

                  <Button
                    type="submit"
                    className="w-full bg-red-800 hover:bg-red-900 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200 text-base"
                  >
                    LOG IN
                  </Button>
                </form>
              </div>
            </div>

            {/* Right side - This div is still needed to maintain the flex layout for the left side */}
            <div className="flex-1"></div>
          </div>
        </div>
      </div>
    </div>
  )
}
