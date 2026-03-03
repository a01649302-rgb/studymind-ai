import { createClient } from '@supabase/supabase-js'

const supabase = createClient(
  process.env.SUPABASE_URL,
  process.env.SUPABASE_KEY
)

export default async function handler(req, res) {

  if (req.method !== 'POST') {
    return res.status(405).json({ error: 'Solo POST' })
  }

  const { nombre, email } = req.body

  const { data, error } = await supabase
    .from('usuarios')
    .insert([{ nombre, email }])

  if (error) {
    return res.status(500).json({ error: error.message })
  }

  res.status(200).json({ success: true, data })
}
